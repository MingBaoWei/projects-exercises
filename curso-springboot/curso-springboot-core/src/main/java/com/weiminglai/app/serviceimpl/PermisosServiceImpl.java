package com.weiminglai.app.serviceimpl;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.weiminglai.app.entity.Permisos;
import com.weiminglai.app.repository.PermisosRepository;
import com.weiminglai.app.service.PermisosService;

@Service
public class PermisosServiceImpl implements PermisosService {

    @Autowired
    private PermisosRepository permisosRepository;

    @Override
    @Transactional(readOnly=true)
    public Iterable<Permisos> findAll() {
        return permisosRepository.findAll();
    }

    @Override
    @Transactional(readOnly=true)
    public Page<Permisos> findAllPaged(Pageable pageable) {
        return permisosRepository.findAll(pageable);
    }

    @Override
    @Transactional(readOnly=true)
    public Optional<Permisos> findById(Long id) {
        return permisosRepository.findById(id);
    }

    @Override
    @Transactional
    public Permisos save(Permisos permisos) {
        return permisosRepository.save(permisos);
    }
    @Override
    @Transactional
    public void deleteById(Long id) {
        permisosRepository.deleteById(id);
    }
}