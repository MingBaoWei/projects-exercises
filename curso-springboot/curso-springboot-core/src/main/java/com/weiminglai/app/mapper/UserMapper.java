package com.weiminglai.app.mapper;

import org.modelmapper.ModelMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.weiminglai.app.DTO.UserDTO;
import com.weiminglai.app.DTO.UserNameDTO;
import com.weiminglai.app.entity.User;

@Component
public class UserMapper {

	@Autowired
	private ModelMapper modelMapper;
	
	public UserDTO convertToDTO(User user) {
	    UserDTO userDTO = modelMapper.map(user, UserDTO.class);
	    
	    if (user.getRol() != null & user.getPermisos() != null) {
	        userDTO.setRol(user.getRol()); 
	        userDTO.setPermisos(user.getPermisos()); 
	    }
	    
	    return userDTO;
	}
	
	public UserNameDTO convertToNameDTO(User user) {
        UserNameDTO userNameDTO = new UserNameDTO();
        userNameDTO.setId(user.getId());
        userNameDTO.setNombreCompleto(user.getName() + " " + user.getSurname());
        userNameDTO.setEmail(user.getEmail());
        userNameDTO.setRol(user.getRol());
        return userNameDTO;
    }
}