package com.weiminglai.app.controllerInt;

import java.util.List;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import com.weiminglai.app.DTO.PermisosDTO;
import com.weiminglai.app.entity.Permisos;

public interface PermisosControllerInt {

    ResponseEntity<?> create(Permisos permisos);

    ResponseEntity<?> read(Long permisosId);

    ResponseEntity<?> update(Permisos permisosDetails, Long permisosId);

    ResponseEntity<?> delete(Long permisosId);

    List<Permisos> readAll();

    ResponseEntity<Page<Permisos>> permisosPaged(Pageable pageable);

    PermisosDTO permisosByIdDTO(Long id);

    PermisosDTO permisosByIdDTOMapp(Long id);
}
