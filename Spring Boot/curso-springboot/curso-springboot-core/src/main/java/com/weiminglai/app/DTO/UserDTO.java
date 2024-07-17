package com.weiminglai.app.DTO;

import java.io.Serializable;
import java.util.Set;

import com.weiminglai.app.entity.Permisos;
import com.weiminglai.app.entity.Rol;

import lombok.Data;

@Data
public class UserDTO implements Serializable{

	private static final long serialVersionUID = 3467054879698713125L;

	private 		Long 			id;
	private 		String 			name;
	private 		String 			surname;
	private 		String 			email;
	private 		Boolean			enabled;
	private 		Rol				rol;
	private 		Set<Permisos> 	permisos;
}
