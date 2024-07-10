package com.weiminglai.app.exception;

public class NoRolException extends RuntimeException{

	private static final long serialVersionUID = -5002602861578069927L;
	
	public NoRolException(Long rolId) {
		super("El rol que introduce no existe.");
	}
}
