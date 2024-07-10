package com.weiminglai.app.controller;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;
import java.util.stream.StreamSupport;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.data.web.PageableDefault;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.weiminglai.app.DTO.RolDTO;
import com.weiminglai.app.controllerInt.RolControllerInt;
import com.weiminglai.app.entity.Rol;
import com.weiminglai.app.mapper.RolMapper;
import com.weiminglai.app.service.RolService;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;

@RestController
@RequestMapping("/api/roles")
@Tag(name = "Rol Controller")
public class RolController implements RolControllerInt{

    @Autowired
    private RolService rolService;
    
    @Autowired
    private RolMapper rolMapper;
    
    @Operation(summary = "Crear nuevo rol")
    @PostMapping
    public ResponseEntity<?> create (@RequestBody Rol rol){
        return ResponseEntity.status(HttpStatus.CREATED).body(rolService.save(rol));
    }
    
    @Operation(summary = "Buscar rol por ID")
    @GetMapping("/{id}")
    public ResponseEntity<?> read (@PathVariable(value = "id") Long roleId){
        Optional<Rol> oRol = rolService.findById(roleId);
        
        if(!oRol.isPresent()) {
            return ResponseEntity.notFound().build();
        }
        
        return ResponseEntity.ok(oRol);
    }
    
    @Operation(summary = "Actualizar rol")
    @PutMapping("/{id}")
    public ResponseEntity<?> update (@RequestBody Rol rolDetails, @PathVariable(value="id") Long roleId) {
        Optional<Rol> rol = rolService.findById(roleId);
        
        if(!rol.isPresent()) {
            return ResponseEntity.notFound().build();
        }
        
        rol.get().setName(rolDetails.getName());
        
        return ResponseEntity.status(HttpStatus.CREATED).body(rolService.save(rol.get()));
    }
    
    @Operation(summary = "Eliminar rol")
    @DeleteMapping("/{id}")
    public ResponseEntity<?> delete (@PathVariable(value = "id") Long roleId) {
        if(!rolService.findById(roleId).isPresent()) {
            return ResponseEntity.notFound().build();
        }
        
        rolService.deleteById(roleId);
        return ResponseEntity.ok().build();
    }
    
    @Operation(summary = "Mostrar todos los roles")
    @GetMapping
    public List<Rol> readAll (){
        List<Rol> roles = StreamSupport
                .stream(rolService.findAll().spliterator(), false)
                .collect(Collectors.toList());
        
        return roles;
    }
    
    @Operation(summary = "Mostrar todos los roles paginado")
    @GetMapping("/paged")
    public ResponseEntity<Page<Rol>> rolesPaged(@PageableDefault(size = 3, sort = "name", direction = Sort.Direction.DESC) Pageable pageable){
        Page<Rol> rolesPage = rolService.findAllPaged(pageable);
        return ResponseEntity.ok(rolesPage);
    }

    @Operation(summary = "Buscar rol por id ODT")
    @GetMapping("/rolDTO/{id}")
    public RolDTO rolByIdDTO(@PathVariable Long id) {
        
        Optional<Rol> opRol = rolService.findById(id);

        Rol rol = opRol.get();
        
        RolDTO rolDTO = new RolDTO();
        rolDTO.setId(rol.getId());
        rolDTO.setName(rol.getName());
        
        return rolDTO;
    }
    
    @GetMapping("/rolDTOMapp/{id}")
    public RolDTO rolByIdDTOMapp(@PathVariable Long id) {
        Optional<Rol> opRol = rolService.findById(id);
        Rol rol = opRol.get();
        return rolMapper.convertToDTO(rol);
    }
}
