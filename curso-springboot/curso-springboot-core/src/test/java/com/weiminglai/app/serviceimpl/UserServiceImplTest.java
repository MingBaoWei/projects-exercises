package com.weiminglai.app.serviceimpl;

import static org.mockito.ArgumentMatchers.any;
import static org.mockito.Mockito.verify;
import static org.mockito.Mockito.when;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.MockitoAnnotations;

import com.weiminglai.app.entity.User;
import com.weiminglai.app.repository.UserRepository;

public class UserServiceImplTest {

	@Mock
	private UserRepository userRepository;

	@InjectMocks
	private UserServiceImpl userService;

	@BeforeEach
	void setUp() {
		MockitoAnnotations.openMocks(this);
	}

	@Test
	void saveUserTest() {
		User userToSave = new User();
		userToSave.setName("John");
		userToSave.setEmail("john@example.com");

		when(userRepository.save(any(User.class))).thenReturn(userToSave);

		User savedUser = userService.save(userToSave);

		verify(userRepository).save(any(User.class));

		Assertions.assertEquals(userToSave, savedUser);
	}
}
