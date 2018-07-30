<?php
/*
** Simple plugin que agrega custom post types al material multimedia de Mercadeo
** Universidad Estatal a Distancia - PEM
** Mover a la carpeta de plugins
*/
function my_custom_posttypes() {
	
	//Capítulos o módulos
    $labelsM = array(
        'name' => 'Módulo',
        'singular_name' => 'Módulo',
        'menu_name' => 'Módulo',
        'name_admin_bar' => 'Módulo',
        'add_new' => 'Agregar Módulo nuevo',
        'add_new_item' => 'Agregar Módulo',
        'new_item' => 'Nuevo Módulo',
        'edit_item' => 'Editar Módulo',
        'view_item' => 'Ver',
        'all_items' => 'Todos los Módulos',
        'search_items' => 'Buscar Módulo',
        'parent_item_colon' => 'Módulo hijo de:',
        'not_found' => 'No se encontraron Módulos.',
        'not_found_in_trash' => 'No hay Módulos en el basurero.',
    );

    $argsM = array(
        'labels' => $labelsM,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-feedback',
        'query_var' => true,
        'rewrite' => array('slug' => 'modulo'),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'thumbnail',
        ),
    );
    register_post_type('modulo', $argsM);

    //Contenidos multimedia
    $labels = array(
        'name' => 'Contenidos principales',
        'singular_name' => 'Contenido',
        'menu_name' => 'Contenido multimedia',
        'name_admin_bar' => 'Contenido multimedia',
        'add_new' => 'Agregar contenido nuevo',
        'add_new_item' => 'Agregar página de contenido',
        'new_item' => 'Nueva página de contenido',
        'edit_item' => 'Editar contenido multimedia',
        'view_item' => 'Ver',
        'all_items' => 'Todo el contenido',
        'search_items' => 'Buscar páginas de contenido',
        'parent_item_colon' => 'Contenido hijo de:',
        'not_found' => 'No se encontraron páginas de contenido.',
        'not_found_in_trash' => 'No hay contenidos en el basurero.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-book',
        'query_var' => true,
        'rewrite' => array('slug' => 'contenidos'),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => 5,
		'taxonomies' => array( 'category' ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes'
        ),
    );
    register_post_type('multimedia', $args);
    
    //Casos
    $labelsC = array(
        'name' => 'Casos de comercialización',
        'singular_name' => 'Caso',
        'menu_name' => 'Caso',
        'name_admin_bar' => 'Caso',
        'add_new' => 'Agregar Caso nuevo',
        'add_new_item' => 'Agregar Caso',
        'new_item' => 'Nuevo Caso',
        'edit_item' => 'Editar Caso',
        'view_item' => 'Ver',
        'all_items' => 'Todos los Casos',
        'search_items' => 'Buscar Caso',
        'parent_item_colon' => 'Página de caso:',
        'not_found' => 'No se encontraron casos.',
        'not_found_in_trash' => 'No hay Caso en la papelera.',
    );

    $argsC = array(
        'labels' => $labelsC,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-welcome-widgets-menus',
        'query_var' => true,
        'rewrite' => array('slug' => 'casos'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes',
            'comments',
            'excerpt'
        ),
    );
    register_post_type('caso', $argsC);
	
//Actividades
    $labelsA = array(
        'name' => 'Actividad de autoevaluación',
        'singular_name' => 'Actividad',
        'menu_name' => 'Actividad',
        'name_admin_bar' => 'Actividad',
        'add_new' => 'Agregar actividad nueva',
        'add_new_item' => 'Agregar actividad',
        'new_item' => 'Nueva actividad',
        'edit_item' => 'Editar',
        'view_item' => 'Ver',
        'all_items' => 'Todas las actividades',
        'search_items' => 'Buscar actividad',
        'parent_item_colon' => 'Actividad:',
        'not_found' => 'No se encontraron actividades.',
        'not_found_in_trash' => 'No hay actividades en la papelera.',
    );

    $argsA = array(
        'labels' => $labelsA,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-carrot',
        'query_var' => true,
        'rewrite' => array('slug' => 'actividades'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'revisions',
	    'comments',
        ),
    );
    register_post_type('actividad', $argsA);
}

add_action('init', 'my_custom_posttypes', 0);

function my_rewrite_flush() {
    my_custom_posttypes();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'my_rewrite_flush');

// Custom Taxonomies
function custom_taxonomies() {

    // Nombre del autor
    $labels = array(
        'name' => 'Autores',
        'singular_name' => 'Autor',
        'search_items' => 'Buscar autor',
        'all_items' => 'Todos',
        'parent_item' => 'ID principal de autor',
        'parent_item_colon' => 'ID principal de autor:',
        'edit_item' => 'Editar autor',
        'update_item' => 'Actualizar autor asignado',
        'add_new_item' => 'Agregar nombre de autor(a)',
        'new_item_name' => 'Nuevo nombre de autor',
        'menu_name' => 'Autor asignado',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'autor'),
    );

    register_taxonomy('autor', array('multimedia'), $args);
    
}

add_action('init', 'custom_taxonomies');