package com.weiminglai.app.DTO;

import java.io.Serializable;
import java.util.Set;

import com.weiminglai.app.entity.Permisos;
import com.weiminglai.app.entity.Rol;

import lombok.Data;

@Data
public class UserNameDTO implements Serializable {

	private static final long serialVersionUID = -3512122600693295948L;

	private Long id;
	private String nombreCompleto;
	private String email;
	private Rol rol;
	private Set<Permisos> permisos;
}