<?php
	//personal auth token from your github.com account.  doing this will eliminate having to use oauth everytime
	$token = "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";
	
	//post url, https://developer.github.com/v3/issues/
	$url = "https://api.github.com/repos/jersonmartinez/geff/issues?access_token=" . $token;

$string = "Acá se colocará una lista de incidencias de FullDevOps, desde la más pequeña a las más grande. \\r\\nSi es posible, fragmentar las grandes incidencias.\\r\\n\\r\\n**FullDevOps - Principal**\\r\\n- [ ] Crear un sistema de redirección de rutas.\\r\\n- [x] Crear diseño y redirección 404.\\r\\n- [x] Crear diseño y redirección 500.\\r\\n- [x] Adaptar correctamente las cards sobre DevOps a todo tipo de pantallas.\\r\\n- [x] Modificar la cabecera\\r\\n- [x] Mejorar el pie de página, agregar las redes sociales en esta sección.\\r\\n- [x] Agregar información sobre FullDevOps como empresa.\\r\\n\\r\\n**GNet - Documentación**\\r\\n- [x] Ordenar la introducción (la definición debe aparecer antes que todo).\\r\\n- [x] Revisar BreadCrumbs. Las funcionalidades no se reflejan en el menú.\\r\\n- [x] Mejorar la actividad del sidebar en dependencia del enlace abierto.\\r\\n- [x] URL de funcionalidades. Evaluar si se deja con o sin \\\" al final, o bien, se redirecciona.\\r\\n\\r\\n**SEO**\\r\\n- [ ] Crear vistas personalizadas para compartir el sitio en redes sociales cómo: WhatsApp, Twitter, Facebook y demás.";

// echo $str;

	//request details, removing slashes and sanitize content
	$title = htmlspecialchars(stripslashes("Artículo: This is a test title"), ENT_QUOTES);
	$body = htmlspecialchars(stripslashes($string), ENT_QUOTES);
	$assignee = "jersonmartinez";
	// $labels = "{'bug', 'documentation', 'duplicate'}";
	
	//build json post
	$post = '{"title": "'. $title .'","body": "'. $string .'","assignee": "'. $assignee.'"}';

	//set file_get_contents header info
	$opts = [
		'http' => [
				'method' => 'POST',
				'header' => [
						'User-Agent: PHP',
						'Content-type: application/x-www-form-urlencoded',
						'Authorization: token '.$token,
				],
				'content' => $post
		]
	];

	//initiate file_get_contents
	$context = stream_context_create($opts);
	
	//make request
	$content = file_get_contents($url, false, $context);
	
	//decode response to array
	$response_array = json_decode($content, true);	
	
	//issue number
	$number = $response_array['number'];

	echo "Issue " . $number . " generated.";

?>