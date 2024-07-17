package com.weiminglai.app.service;

import java.util.Optional;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;

import com.weiminglai.app.entity.Permisos;

public interface PermisosService {

	public Iterable<Permisos> findAll();
	
	public Page<Permisos> findAllPaged(Pageable pageable);
	
	public Optional<Permisos> findById(Long id);
	
	public Permisos save(Permisos permisos);
	
	public void deleteById(Long id);
}