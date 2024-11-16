<?php

return [
	'create' => 'Crear',
	'save' => 'Guardar',
	'edit' => 'Editar',
	'view' => 'Ver',
	'update' => 'Actualizar',
	'list' => 'Lista',
	'no_entries_in_table' => 'No hay entradas en la tabla',
	'custom_controller_index' => 'Índice de controlador personalizado',
	'logout' => 'Cerrar sesión',
	'add_new' => 'Agregar nuevo',
	'are_you_sure' => '¿Estás seguro?',
	'back_to_list' => 'Volver a la lista',
	'dashboard' => 'Dashboard',
	'delete' => 'Eliminar',
	'quickadmin_title' => 'LaraQuiz',

	'user-management' => [
		'title' => 'Gestión de usuarios',
		'fields' => [
		],
	],

    'test' => [
        'new' => 'Nuevo cuestionario',
    ],

	'roles' => [
		'title' => 'Roles',
		'fields' => [
			'title' => 'Título',
		],
	],

	'users' => [
		'title' => 'Usuarios',
		'fields' => [
			'name' => 'Nombre',
			'email' => 'Correo electrónico',
			'password' => 'Contraseña',
			'role' => 'Role',
			'remember-token' => 'Recordar token',
		],
	],

	'user-actions' => [
		'title' => 'Acciones del usuario',
		'fields' => [
			'user' => 'Usuario',
			'action' => 'Acción',
			'action-model' => 'Modelo de acción',
			'action-id' => 'Action id',
		],
	],

	'topics' => [
		'title' => 'Temas',
		'fields' => [
		'title' => 'Título',
		],
	],

	'questions' => [
		'title' => 'Preguntas',
		'fields' => [
			'topic' => 'Tema',
			'question-text' => 'Texto de pregunta',
			'code-snippet' => 'Fragmento de código',
			'answer-Explorer' => 'Explicación de respuesta',
			'more-info-link' => 'Más enlace de información',
		],
	],

	'questions-options' => [
		'title' => 'Opciones de preguntas',
		'fields' => [
			'question' => 'question',
			'option' => 'Opción',
			'correct' => 'Correcto',
		],
	],

	'results' => [
		'title' => 'Mis resultados',
		'fields' => [
			'user' => 'Usuario',
			'question' => 'Pregunta',
			'correct' => 'Correcto',
			'date' => 'Fecha',
			'result' => 'Puntaje',
		],
	],

	'laravel-quiz' => 'Nuevo cuestionario',
	'quiz' => 'Responda estas',
	'quantity' => 'preguntas. No hay límite de tiempo.',
	'submit_quiz' => 'Enviar respuestas',
	'view-result' => 'Ver resultado',
];