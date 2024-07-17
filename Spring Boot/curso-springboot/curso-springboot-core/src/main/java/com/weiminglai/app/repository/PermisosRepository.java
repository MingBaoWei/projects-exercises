package com.weiminglai.app.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.weiminglai.app.entity.Permisos;

@Repository
public interface PermisosRepository extends JpaRepository<Permisos, Long>{
	
}
