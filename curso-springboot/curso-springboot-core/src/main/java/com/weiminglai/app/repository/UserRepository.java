package com.weiminglai.app.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.weiminglai.app.entity.User;

@Repository
public interface UserRepository extends JpaRepository<User, Long>{
	
	//Eejrcicio 2 PRACTICA 1
	public List<User> findByEnabled(boolean enabled);
	
}
