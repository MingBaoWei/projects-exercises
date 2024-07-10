package com.weiminglai.app.controllerInt;

import com.weiminglai.app.DTO.RolDTO;
import com.weiminglai.app.entity.Rol;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;

import java.util.List;

public interface RolControllerInt {
    ResponseEntity<?> create(Rol rol);
    ResponseEntity<?> read(Long roleId);
    ResponseEntity<?> update(Rol rolDetails, Long roleId);
    ResponseEntity<?> delete(Long roleId);
    List<Rol> readAll();
    ResponseEntity<Page<Rol>> rolesPaged(Pageable pageable);
    RolDTO rolByIdDTO(Long id);
    RolDTO rolByIdDTOMapp(Long id);
}
