Vagrant.configure("2") do |config|
  
  BASE_INT_NETWORK = "10.10.20"
  BASE_HOST_ONLY_NETWORK = "192.168.56"
  PROXY_ENABLE = false

  if Vagrant.has_plugin?("vagrant-proxyconf") && PROXY_ENABLE == true
    config.proxy.http     = "http://proxy.cpt.local:8080"
    config.proxy.https    = "http://proxy.cpt.local:8080"
  end  
  
  config.vm.define "web" do |webconfig|
    webconfig.vm.hostname = "web.m340"
    webconfig.vm.box = "ubuntu/jammy64"
    webconfig.vm.synced_folder "website/", "/var/www/html"
    webconfig.ssh.insert_key = false # Abilitare con errore vagrant@127.0.0.1: Permission denied (publickey).

    webconfig.vm.provider "virtualbox" do |vb|
      vb.name = "web.m340"
      vb.memory = "2048"
      vb.cpus = 2
    end

    # Network
    webconfig.vm.network "private_network", name: "VirtualBox Host-Only Ethernet Adapter", ip: "#{BASE_HOST_ONLY_NETWORK}.10"
    webconfig.vm.network "private_network", ip: "#{BASE_INT_NETWORK}.10", virtualbox__intnet: true
  
    # Provisioning
    webconfig.vm.provision "shell", path: "web_provisioning.sh"

    
  end

  config.vm.define "db" do |dbconfig|
    dbconfig.vm.hostname = "db.m340"
    dbconfig.vm.box = "ubuntu/jammy64"
    dbconfig.vm.synced_folder "scripts/", "/home/vagrant/.scripts/"
    dbconfig.ssh.insert_key = false # Abilitare con errore vagrant@127.0.0.1: Permission denied (publickey).

    dbconfig.vm.provider "virtualbox" do |vb|
      vb.name = "db.m340"
      vb.memory = "2048"
      vb.cpus = 2
    end
    
    # Network
    dbconfig.vm.network "private_network", ip: "#{BASE_INT_NETWORK}.11", virtualbox__intnet: true

    # Provisioning
    dbconfig.vm.provision "shell", path: "db_provisioning.sh"
  end

end