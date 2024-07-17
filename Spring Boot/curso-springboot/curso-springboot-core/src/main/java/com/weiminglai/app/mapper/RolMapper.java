package com.weiminglai.app.mapper;

import org.modelmapper.ModelMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.weiminglai.app.DTO.RolDTO;
import com.weiminglai.app.entity.Rol;


@Component
public class RolMapper {

	@Autowired
	private ModelMapper modelMapper;
	
	public RolDTO convertToDTO(Rol rol) {
        return modelMapper.map(rol, RolDTO.class);
    }
}
