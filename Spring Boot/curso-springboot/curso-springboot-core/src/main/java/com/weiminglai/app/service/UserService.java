package com.weiminglai.app.service;

import java.util.List;
import java.util.Optional;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;

import com.weiminglai.app.entity.User;

public interface UserService {
	
	public Iterable<User> findAll();
	
	//Ejercicio 2 PRACTICA 2
	public Page<User> findAllPaged(Pageable pageable);
	
	public Optional<User> findById(Long id);
	
	public User save(User user);
	
	public void deleteById(Long id);
	
	//Ejercicio 2 PRACTICA 1
	public List<User> findEnabledUsers();
}
