package com.weiminglai.app.mapper;

import org.modelmapper.ModelMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.weiminglai.app.DTO.PermisosDTO;
import com.weiminglai.app.entity.Permisos;


@Component
public class PermisosMapper {

	@Autowired
	private ModelMapper modelMapper;
	
	public PermisosDTO convertToDTO(Permisos permisos) {
        return modelMapper.map(permisos, PermisosDTO.class);
    }
}
