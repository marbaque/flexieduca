<?php
/*
Simple plugin que agrega custom post types al material multimedia de Mercadeo
Universidad Estatal a Distancia - PEM
*/
function my_custom_posttypes() {

    //Contenidos multimedia
    $labels = array(
        'name' => 'Contenido',
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
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes',
            'comments'
        ),
    );
    register_post_type('multimedia', $args);
    
    //Casos
    $labelsC = array(
        'name' => 'Caso de comercialización',
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
        'hierarchical' => true,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes',
            'comments'
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
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'revisions',
			'comments'
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
    
    //estrategias
    $labelsT = array(
        'name' => 'Estrategia',
        'singular_name' => 'Estrategia',
        'search_items' => 'Buscar estrategia',
        'all_items' => 'Todas',
        'parent_item' => 'ID principal de la estrategia',
        'parent_item_colon' => 'ID principal de la estrategia:',
        'edit_item' => 'Editar estrategia',
        'update_item' => 'Actualizar estrategia asignada',
        'add_new_item' => 'Nombrar la estrategia',
        'new_item_name' => 'Nueva estrategia',
        'menu_name' => 'Estrategia asignada',
    );

    $argsT = array(
        'hierarchical' => false,
        'labels' => $labelsT,
        'show_ui' => true,
        'show_admin_column' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'tendencia'),
    );

    register_taxonomy('tendencia', array('caso'), $argsT);
}

add_action('init', 'custom_taxonomies');




