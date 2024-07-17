package com.weiminglai.app.serviceimpl;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.weiminglai.app.entity.Rol;
import com.weiminglai.app.repository.RolRepository;
import com.weiminglai.app.service.RolService;


@Service
public class RolServiceImpl implements RolService{
	
	@Autowired
	private RolRepository rolRepository;
	
	@Override
	@Transactional(readOnly=true)
	public Iterable<Rol> findAll() {
		return rolRepository.findAll();
	}

	@Override
	@Transactional(readOnly=true)
	public Page<Rol> findAllPaged(Pageable pageable) {
		return rolRepository.findAll(pageable);
	}

	@Override
	@Transactional(readOnly=true)
	public Optional<Rol> findById(Long id) {
		return rolRepository.findById(id);
	}

	@Override
	@Transactional
	public Rol save(Rol rol) {
		return rolRepository.save(rol);
	}

	@Override
	@Transactional
	public void deleteById(Long id) {
		rolRepository.deleteById(id);
	}
	
}
