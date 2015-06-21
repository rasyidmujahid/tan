set :scm, :git
set :repo_url, 'git@github.com:rasyidmujahid/tan.git'

set :ssh_options, {
  forward_agent: true,
  port: 3456
}

set :branch, :master
set :deploy_to, -> { "/var/www/html/#{fetch(:application)}" }
set :log_level, :debug

SSHKit.config.command_map[:composer] = "php /var/local/composer/composer.phar"

# Apache users with .htaccess files:
# it needs to be added to linked_files so it persists across deploys:
# set :linked_files, %w{.env web/.htaccess}
set :linked_files, %w{.env}
set :linked_dirs, %w{web/app/uploads}

namespace :deploy do
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :service, :nginx, :reload
    end
  end
end

# The above restart task is not run by default
# Uncomment the following line to run it on deploys if needed
# after 'deploy:publishing', 'deploy:restart'
