# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # https://docs.vagrantup.com : Documentation.

  # The one we used in the labs suits my use well
  config.vm.box = "ubuntu/xenial64"

  config.vm.define "frontendwebserver" do |frontendwebserver|
    frontendwebserver.vm.hostname = "frontendwebserver"
    frontendwebserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    frontendwebserver.vm.network "private_network", ip: "192.168.33.10"

    frontendwebserver.vm.provision "shell", inline: <<-SHELL
      apt-get update
      # My frontend will run on php and will write data to a mysql server
      apt-get install -y apache2 php libapache2-mod-php php-mysql
    SHELL
  end

end
