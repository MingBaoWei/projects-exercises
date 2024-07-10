package com.weiminglai.app.entity;

import java.io.Serializable;
import java.util.HashSet;
import java.util.Set;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.JoinTable;
import jakarta.persistence.ManyToMany;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import lombok.Data;

@Entity
@Table(name = "users")
@Data
public class User implements Serializable {

	private static final long serialVersionUID = 2625302342524597249L;

	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;

	@Column(length = 50)
	private String name;
	private String surname;
	@Column(name = "mail", nullable = false, length = 50, unique = true)
	private String email;
	private Boolean enabled;

	@ManyToOne
	@JoinColumn(name = "rol_id")
	private Rol rol;

	@ManyToMany
	@JoinTable(name = "user_permisos", joinColumns = @JoinColumn(name = "user_id"), inverseJoinColumns = @JoinColumn(name = "permisos_id"))
	private Set<Permisos> permisos = new HashSet<>();
}
