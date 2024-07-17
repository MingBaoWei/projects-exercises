package com.weiminglai.app.controller;

import java.util.List;
import java.util.Optional;
import java.util.Set;
import java.util.stream.Collectors;
import java.util.stream.StreamSupport;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.data.web.PageableDefault;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.weiminglai.app.DTO.UserDTO;
import com.weiminglai.app.DTO.UserNameDTO;
import com.weiminglai.app.controllerInt.UserControllerInt;
import com.weiminglai.app.entity.Permisos;
import com.weiminglai.app.entity.Rol;
import com.weiminglai.app.entity.User;
import com.weiminglai.app.exception.NoPermisosException;
import com.weiminglai.app.exception.NoRolException;
import com.weiminglai.app.mapper.UserMapper;
import com.weiminglai.app.service.PermisosService;
import com.weiminglai.app.service.RolService;
import com.weiminglai.app.service.UserService;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;

@RestController
@RequestMapping("/api/users")

@Tag(name = "User Controller")
public class UserController implements UserControllerInt {

	private static final Logger logger = LoggerFactory.getLogger(UserController.class);

	@Autowired
	private UserService userService;
	@Autowired
	private UserMapper userMapper;

	@Autowired
	private RolService rolService;

	@Autowired
	private PermisosService permisosService;

	// Create a new user
	@Operation(summary = "Crear nuevo usuario Y ASIGNAR ROL y Permisos")
	@PostMapping
	public ResponseEntity<?> create(@RequestBody User user) {

		logger.info("Iniciando creación de un nuevo usuario");

		// -------------ROL-------------
		Rol rol = user.getRol();

		Optional<Rol> existingRol = rolService.findById(rol.getId());
		if (!existingRol.isPresent()) {
			logger.error("El rol con el ID {} no existe", rol.getId());
			throw new NoRolException(rol.getId());
		}

		user.setRol(existingRol.get());

		// -------------PERMISOS-------------
		Set<Permisos> permisos = user.getPermisos();

		Set<Permisos> existingPermisos = permisos.stream().map(permiso -> permisosService.findById(permiso.getId()))
				.filter(Optional::isPresent).map(Optional::get).collect(Collectors.toSet());

		if (existingPermisos.size() != permisos.size()) {
			logger.error("Al menos uno de los permisos asignados al usuario no existe");
			throw new NoPermisosException();
		}

		user.setPermisos(existingPermisos);

		User savedUser = userService.save(user);

		logger.info("Usuario creado exitosamente con ID: {}", savedUser.getId());
		return ResponseEntity.status(HttpStatus.CREATED).body(savedUser);
	}

	// Read an user
	@Operation(summary = "Buscar usuario por ID")
	@GetMapping("/{id}")
	public ResponseEntity<?> read(@PathVariable(value = "id") Long userId) {
		logger.info("Iniciando la búsqueda del usuario con el ID proporcionado");
		Optional<User> oUser = userService.findById(userId);

		if (!oUser.isPresent()) {
			logger.error("No existe el usuario buscado");
			return ResponseEntity.notFound().build();
		}
		logger.info("Búsqueda exitosa");
		return ResponseEntity.ok(oUser);
	}

	// Update an user
	@Operation(summary = "Actualziar usuario")
	@PutMapping("/{id}")
	public ResponseEntity<?> update(@RequestBody User userDetails, @PathVariable(value = "id") Long userId) {
		logger.info("Iniciando actualización del Usuario introducido");
		Optional<User> user = userService.findById(userId);

		if (!user.isPresent()) {
			logger.error("No existe el usuario buscado");
			return ResponseEntity.notFound().build();
		}

		User existingUser = user.get();
		existingUser.setName(userDetails.getName());
		existingUser.setSurname(userDetails.getSurname());
		existingUser.setEmail(userDetails.getEmail());
		existingUser.setEnabled(userDetails.getEnabled());

		// -------------ROL-------------
		Rol rol = userDetails.getRol();
		Optional<Rol> existingRol = rolService.findById(rol.getId());
		if (!existingRol.isPresent()) {
			return ResponseEntity.badRequest().body("El rol con el id: " + rol.getId() + " no existe.");
		}

		existingUser.setRol(existingRol.get());

		// -------------PERMISOS-------------
		Set<Permisos> permisos = userDetails.getPermisos();

		Set<Permisos> existingPermisos = permisos.stream().map(permiso -> permisosService.findById(permiso.getId()))
				.filter(Optional::isPresent).map(Optional::get).collect(Collectors.toSet());

		if (existingPermisos.size() != permisos.size()) {
			return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Al menos uno de los permisos no existe.");
		}

		existingUser.setPermisos(existingPermisos);

		User updatedUser = userService.save(existingUser);
		logger.info("Actualización exitosa");
		return ResponseEntity.status(HttpStatus.CREATED).body(updatedUser);
	}

	// Delete an user
	@Operation(summary = "Eliminar usuario")
	@DeleteMapping("/{id}")
	public ResponseEntity<?> delete(@PathVariable(value = "id") Long userId) {
		logger.info("Iniciando la eliminación del Usuario introducido");
		if (!userService.findById(userId).isPresent()) {
			logger.error("No existe el usuario buscado");
			return ResponseEntity.notFound().build();
		}

		userService.deleteById(userId);
		logger.info("Usuario eliminado exitosamente");
		return ResponseEntity.ok().build();
	}

	// Read all users
	@Operation(summary = "Mostrar todos los usuarios")
	@GetMapping
	public List<User> readAll() {
		List<User> users = StreamSupport.stream(userService.findAll().spliterator(), false)
				.collect(Collectors.toList());

		return users;
	}

	// Ejercicio 2 PRACTICA 1: Find enabled users
	@Operation(summary = "Buscar usuarios activos")
	@GetMapping("/enabledUsers")
	public List<User> findEnabled() {
		List<User> lUsers = userService.findEnabledUsers();

		return lUsers;
	}

	// Ejercicio 2 PRACTICA 2: All Users paged
	@Operation(summary = "Mostrar todos los usuarios paginado")
	@GetMapping("/paged")
	// Para ver otras paginas --> /paged?page=n Siendo n el numero de la página.
	public ResponseEntity<Page<User>> usersPaged(
			@PageableDefault(size = 3, sort = "name", direction = Sort.Direction.DESC) Pageable pageable) {
		Page<User> usersPage = userService.findAllPaged(pageable);
		return ResponseEntity.ok(usersPage);
	}

	// Ejercicio 6 PRACTICA 1: UserDTO
	@Operation(summary = "Buscar user por id ODT")
	@GetMapping("/userDTO/{id}")
	public UserDTO userByIdDTO(@PathVariable Long id) {

		Optional<User> opUser = userService.findById(id);

		User user = opUser.get();

		UserDTO userDTO = new UserDTO();
		userDTO.setId(user.getId());
		userDTO.setName(user.getName());
		userDTO.setSurname(user.getSurname());
		userDTO.setEmail(user.getEmail());
		userDTO.setEnabled(user.getEnabled());
		userDTO.setRol(user.getRol());
		userDTO.setPermisos(user.getPermisos());

		return userDTO;
	}

	// Ejercicio 6 PRACTICA 2: UserNameDTO
	@Operation(summary = "Buscar user por id ODT NombreCompleto sin variable Enabled")
	@GetMapping("/userNameDTO/{id}")
	public UserNameDTO userNameByIdDTO(@PathVariable Long id) {

		Optional<User> opUser = userService.findById(id);

		User user = opUser.get();

		UserNameDTO userNameDTO = new UserNameDTO();
		userNameDTO.setId(user.getId());
		userNameDTO.setNombreCompleto(user.getName() + " " + user.getSurname());
		userNameDTO.setEmail(user.getEmail());
		userNameDTO.setRol(user.getRol());
		userNameDTO.setPermisos(user.getPermisos());

		return userNameDTO;

	}

	// Ejercicio 6 PRACTICA 3: Mapper
	@Operation(summary = "Buscar user por id ODT y Mapper")
	@GetMapping("/userDTOMapp/{id}")
	public UserDTO userByIdDTOMapp(@PathVariable Long id) {
		Optional<User> opUser = userService.findById(id);
		User user = opUser.get();
		return userMapper.convertToDTO(user);
	}

	@Operation(summary = "Buscar user por id ODT NombreCompleto sin variable Enabled usando el mapper")
	@GetMapping("/userNameDTOMapp/{id}")
	public UserNameDTO userNameByIdDTOMapp(@PathVariable Long id) {
		Optional<User> opUser = userService.findById(id);
		User user = opUser.get();
		return userMapper.convertToNameDTO(user);
	}

	// Ejercicio 7 PRACTICA 7
	@Operation(summary = "Buscar user que no tienen permisos")
	@GetMapping("/usersWihoutPermisos")
	public List<User> getUsersWithRoleWithoutPermissions() {

		List<User> allUsers = StreamSupport.stream(userService.findAll().spliterator(), false)
				.collect(Collectors.toList());

		List<User> usersWithoutPermisos = allUsers.stream()
				.filter(user -> user.getRol() != null && (user.getPermisos() == null || user.getPermisos().isEmpty()))
				.collect(Collectors.toList());

		return usersWithoutPermisos;
	}

	@ExceptionHandler(NoRolException.class)
	public ResponseEntity<?> handleRolNoExisteException(NoRolException ex) {
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(ex.getMessage());
	}

	@ExceptionHandler(NoPermisosException.class)
	public ResponseEntity<?> handlePermisosNoExistenException(NoPermisosException ex) {
		return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(ex.getMessage());
	}
}
