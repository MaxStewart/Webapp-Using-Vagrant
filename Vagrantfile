# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # https://docs.vagrantup.com : Documentation.

  # The one we used in the labs suits my use well
  config.vm.box = "ubuntu/xenial64"

  config.vm.define "frontendwebserver" do |frontendwebserver|
    frontendwebserver.vm.hostname = "frontendwebserver"
    frontendwebserver.vm.network "forwarded_port", guest: 80, host: 10222, host_ip: "127.0.0.1"
    frontendwebserver.vm.network "private_network", ip: "192.168.33.10"
	
	frontendwebserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    
	frontendwebserver.vm.provision "shell", inline: <<-SHELL
      apt-get update
      # My frontend will run on php and will write data to a mysql server
      apt-get install -y apache2 php libapache2-mod-php php-mysql
	  
	  # Change VM's webserver's configuration to use shared folder.
      # (Look inside test-website.conf for specifics.)
      cp /vagrant/test-website1.conf /etc/apache2/sites-available/
      # install our website configuration and disable the default
      a2ensite test-website1
      a2dissite 000-default
      service apache2 reload
    SHELL
  end
  
  config.vm.define "backendwebserver" do |backendwebserver|
	backendwebserver.vm.hostname = "backendwebserver"
	backendwebserver.vm.network "forwarded_port", guest: 80, host: 10122, host_ip: "127.0.0.1"
	backendwebserver.vm.network "private_network", ip: "192.168.2.12"

	backendwebserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

	backendwebserver.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
	  
	  # Change VM's webserver's configuration to use shared folder.
      # (Look inside test-website.conf for specifics.)
      cp /vagrant/test-website2.conf /etc/apache2/sites-available/
      # install our website configuration and disable the default
      a2ensite test-website2
      a2dissite 000-default
      service apache2 reload
	SHELL
	end
end
