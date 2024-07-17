package com.weiminglai.app.service;

import java.util.Optional;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;

import com.weiminglai.app.entity.Rol;

public interface RolService {

	public Iterable<Rol> findAll();
	
	public Page<Rol> findAllPaged(Pageable pageable);
	
	public Optional<Rol> findById(Long id);
	
	public Rol save(Rol rol);
	
	public void deleteById(Long id);
}
