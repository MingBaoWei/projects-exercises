package com.weiminglai.app.exception;

public class NoPermisosException extends RuntimeException{

	private static final long serialVersionUID = -3908323777211747832L;

	public NoPermisosException() {
		super("Al menos uno de los permisos asignados al usuario no existe");
	}
}
