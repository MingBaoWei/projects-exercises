package com.weiminglai.app.controllerInt;

import com.weiminglai.app.DTO.UserDTO;
import com.weiminglai.app.DTO.UserNameDTO;
import com.weiminglai.app.entity.User;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;

import java.util.List;

public interface UserControllerInt {
    ResponseEntity<?> create(User user);
    ResponseEntity<?> read(Long userId);
    ResponseEntity<?> update(User userDetails, Long userId);
    ResponseEntity<?> delete(Long userId);
    List<User> readAll();
    List<User> findEnabled();
    ResponseEntity<Page<User>> usersPaged(Pageable pageable);
    UserDTO userByIdDTO(Long id);
    UserNameDTO userNameByIdDTO(Long id);
    UserDTO userByIdDTOMapp(Long id);
    UserNameDTO userNameByIdDTOMapp(Long id);
    List<User> getUsersWithRoleWithoutPermissions();
}
