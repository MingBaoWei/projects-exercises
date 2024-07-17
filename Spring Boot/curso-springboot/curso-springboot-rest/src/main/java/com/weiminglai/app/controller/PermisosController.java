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

import com.weiminglai.app.DTO.PermisosDTO;
import com.weiminglai.app.controllerInt.PermisosControllerInt;
import com.weiminglai.app.entity.Permisos;
import com.weiminglai.app.mapper.PermisosMapper;
import com.weiminglai.app.service.PermisosService;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;

@RestController
@RequestMapping("/api/permisos")
@Tag(name = "Permisos Controller")
public class PermisosController implements PermisosControllerInt{

    @Autowired
    private PermisosService permisosService;
    
    @Autowired
    private PermisosMapper permisosMapper;
    
    @Operation(summary = "Crear nuevo permiso")
    @PostMapping
    public ResponseEntity<?> create (@RequestBody Permisos permisos){
        return ResponseEntity.status(HttpStatus.CREATED).body(permisosService.save(permisos));
    }
    
    @Operation(summary = "Buscar permiso por ID")
    @GetMapping("/{id}")
    public ResponseEntity<?> read (@PathVariable(value = "id") Long permisosId){
        Optional<Permisos> oPermisos = permisosService.findById(permisosId);
        
        if(!oPermisos.isPresent()) {
            return ResponseEntity.notFound().build();
        }
        
        return ResponseEntity.ok(oPermisos);
    }
    
    @Operation(summary = "Actualizar permiso")
    @PutMapping("/{id}")
    public ResponseEntity<?> update (@RequestBody Permisos permisosDetails, @PathVariable(value="id") Long permisosId) {
        Optional<Permisos> permisos = permisosService.findById(permisosId);
        
        if(!permisos.isPresent()) {
            return ResponseEntity.notFound().build();
        }
        
        permisos.get().setTitulo(permisosDetails.getTitulo());
        
        return ResponseEntity.status(HttpStatus.CREATED).body(permisosService.save(permisos.get()));
    }
    
    @Operation(summary = "Eliminar permiso")
    @DeleteMapping("/{id}")
    public ResponseEntity<?> delete (@PathVariable(value = "id") Long permisosId) {
        if(!permisosService.findById(permisosId).isPresent()) {
            return ResponseEntity.notFound().build();
        }
        
        permisosService.deleteById(permisosId);
        return ResponseEntity.ok().build();
    }
    
    @Operation(summary = "Mostrar todos los permisos")
    @GetMapping
    public List<Permisos> readAll (){
        List<Permisos> permisos = StreamSupport
                .stream(permisosService.findAll().spliterator(), false)
                .collect(Collectors.toList());
        
        return permisos;
    }
    
    @Operation(summary = "Mostrar todos los permisos paginado")
    @GetMapping("/paged")
    public ResponseEntity<Page<Permisos>> permisosPaged(@PageableDefault(size = 3, sort = "name", direction = Sort.Direction.DESC) Pageable pageable){
        Page<Permisos> permisosPage = permisosService.findAllPaged(pageable);
        return ResponseEntity.ok(permisosPage);
    }

    @Operation(summary = "Buscar permiso por id ODT")
    @GetMapping("/permisosDTO/{id}")
    public PermisosDTO permisosByIdDTO(@PathVariable Long id) {
        Optional<Permisos> opPermisos = permisosService.findById(id);

        Permisos permisos = opPermisos.get();
        
        PermisosDTO permisosDTO = new PermisosDTO();
        permisosDTO.setId(permisos.getId());
        permisosDTO.setTitulo(permisos.getTitulo());
        
        return permisosDTO;
    }
    
    @GetMapping("/permisosDTOMapp/{id}")
    public PermisosDTO permisosByIdDTOMapp(@PathVariable Long id) {
        Optional<Permisos> opPermisos = permisosService.findById(id);
        Permisos permisos = opPermisos.get();
        return permisosMapper.convertToDTO(permisos);
    }
}
