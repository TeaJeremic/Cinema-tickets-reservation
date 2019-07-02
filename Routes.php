<?php
    use App\Core\Route;

    return [
        Route::get('#^administrator/home/?$#',       'AdministratorPocetna',         'index'),
        Route::post('#^administrator/logout/?$#',    'Main',                         'loginOut'),
        Route::get('#^administrator/login/?$#',      'Main',                         'loginGet'),
        Route::post('#^administrator/login/?$#',     'Main',                         'loginPost'),
    
        Route::get('|^administrator/film/?$|',        'AdministratorDodavanjeFilma',       'getAdd'),
        Route::get('|^administrator/projekcija/?$|',  'AdministratorDodavanjeProjekcija',  'getAdd'),
        Route::post('|^administrator/film/?$|',       'AdministratorDodavanjeFilma',      'postAdd'),
        Route::post('|^administrator/projekcija/?$|', 'AdministratorDodavanjeProjekcija', 'postAdd'),
        
        
        Route::get('#^filmovi/?$#',                     'Main',         'home'),
        Route::get('#^projekcije/?$#',               'Main',         'showFilmskeProjekcije'),
        Route::get('|^film/([0-9]+)/?$|',            'Main',         'showFilmskeProjekcije'),
        Route::get('#^projekcija/([0-9]+)/?$#',      'Projekcija',   'show'),
       // Route::post('|^search/?$|',                  'Projekcija',   'show'),
        Route::post('|^search/?$|',                  'Film',   'postSearch'),
        //Route::get('#^sala/?$#',                     'Rezervacija',         'getAdd'),
        Route::get('#^sala/([0-9]+)/?$#',            'Rezervacija',         'getAdd'),
        Route::post('#^sala/([0-9]+)/?$#',            'Rezervacija',         'postAdd'),
        
    
        #Route::get('#^api/filmovi/?$#',                 'MainApi',        'filmovi'),
        #Route::get('#^api/projekcije/([0-9]+)/?$#',     'MainApi',        'auctions'),
        #Route::get('#^api/bookmarks/?$#',               'BookmarkApi',    'getBookmarks'),
        #Route::get('#^api/bookmarks/add/([0-9]+)/?$#',  'BookmarkApi',    'addBookmark'),
        #Route::get('#^api/bookmarks/clear/?$#',         'BookmarkApi',    'clear'),
        #Route::post('#^api/projekcija/bid/?$#',         'UserAuctionApi', 'postBid'),

        Route::get('#^administrator/filmovi/?$#',                'AdministratorDodavanjeFilma', 'filmovi'),
        Route::get('#^administrator/filmovi/add/?$#',            'AdministratorDodavanjeFilma', 'getAdd'),
        Route::post('#^administrator/filmovi/add/?$#',           'AdministratorDodavanjeFilma', 'postAdd'),
        Route::get('#^administrator/filmovi/edit/([0-9]+)/?$#',  'AdministratorDodavanjeFilma', 'getEdit'),
        Route::post('#^administrator/filmovi/edit/([0-9]+)/?$#', 'AdministratorDodavanjeFilma', 'postEdit'),

        Route::get('#^administrator/projekcije/?$#',                  'AdministratorDodavanjeProjekcija', 'projekcije'),
        Route::get('#^administrator/projekcije/add/?$#',              'AdministratorDodavanjeProjekcija', 'getAdd'),
        Route::post('#^administrator/projekcije/add/?$#',             'AdministratorDodavanjeProjekcija', 'postAdd'),
        Route::get('#^administrator/projekcije/edit/([0-9]+)/?$#',    'AdministratorDodavanjeProjekcija', 'getEdit'),
        Route::post('#^administrator/projekcije/edit/([0-9]+)/?$#',   'AdministratorDodavanjeProjekcija', 'postEdit'),

        
        # Secret routes
        Route::get('#^tasks/sendNotifications/([A-z0-9]{64})/?$#', 'Task', 'sendNotifications'),

        # Fallback
        Route::get('#^.*$#', 'Main', 'home')
    ];
