package com.weiminglai.app.DTO;

import java.io.Serializable;

import lombok.Data;

@Data
public class RolDTO implements Serializable{

	private static final long serialVersionUID = 44294524285428574L;
	
	private Long id;
	private String name;
}
