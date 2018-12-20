<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'guide.humandata.info');

// Project repository
set('repository', 'git@github.com:Humandata/guide.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('guide.humandata.info')
    ->set('deploy_path', '/home/relaxmax/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

// test
task('test', function () {
    writeln('Hello world');
});

// pwd
task('pwd', function () {
    $result = run('pwd');
     writeln("Current dir: $result");
});
