package com.weiminglai.app.configs;

import org.springframework.context.annotation.Configuration;

import io.swagger.v3.oas.annotations.OpenAPIDefinition;
import io.swagger.v3.oas.annotations.info.Info;

@Configuration
@OpenAPIDefinition(
		info = @Info(
				title = "cursoSpringBoot",
				version = "1.0.0",
				description = "Mi curso Spring"
		)
)
public class configSwagger {

}
