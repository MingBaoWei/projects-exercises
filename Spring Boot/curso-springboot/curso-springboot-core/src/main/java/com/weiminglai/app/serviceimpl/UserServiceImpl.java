package com.weiminglai.app.serviceimpl;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.weiminglai.app.entity.User;
import com.weiminglai.app.repository.UserRepository;
import com.weiminglai.app.service.UserService;

@Service
public class UserServiceImpl implements UserService{

	@Autowired
	private UserRepository userRepository;
	
	@Override
	@Transactional(readOnly=true)
	public Iterable<User> findAll() {
		return userRepository.findAll();
	}

	//Ejercicio 2 PRACTICA 2
	@Override
	@Transactional(readOnly=true)
	public Page<User> findAllPaged(Pageable pageable) {
		return userRepository.findAll(pageable);
	}

	@Override
	@Transactional(readOnly=true)
	public Optional<User> findById(Long id) {
		return userRepository.findById(id);
	}

	@Override
	@Transactional
	public User save(User user) { 
		return userRepository.save(user);
	}

	@Override
	@Transactional
	public void deleteById(Long id) {
		userRepository.deleteById(id);
	}
	
	//Ejercicio 2 PRACTICA 1
	@Override
	@Transactional(readOnly=true)
	public List<User> findEnabledUsers() {
		return userRepository.findByEnabled(true);
	}
	
}
