# Ben Kinney's MVC CRUD Project Environment Setup

## Prerequisites

- Virtualbox >= 5.1
- Vagrant >= 1.8.6
- Git
- Root access to your local machine

## Getting your Environment Setup
- Download or clone [this Git repository](https://github.com/blkinney/formstack-devtest).
- Add the Vagrant box "precise32".

    ```
    vagrant box add precise32 http://files.vagrantup.com/precise32.box
    ```

- Start Vagrant using the Vagrantfile supplied in the repository.

    ```
    vagrant up
    ```

- Make sure your SSH is configured to work with Github -
    [https://help.github.com/articles/generating-an-ssh-key/](https://help.github.com/articles/generating-an-ssh-key/)
- Update your `/etc/hosts` file

    ```
    echo 192.168.59.76   testbox.dev www.testbox.dev | sudo tee -a /etc/hosts
    ```

- Next you can simply use the `vagrant up` command to start provisioning your local environment!
- Adding an index.php file into your repository should allow you to see its contents at http://www.testbox.dev
- Remember part of the process is to see how you work so commit and push changes as you would on day to day projects.

| Type           | Value                  |
|----------------|------------------------|
| MySQL Username | my_app                 |
| Mysql Password | secret                 |
| Mysql Database | my_app                 |
| SSH Username   | vagrant                |
| SSH Password   | vagrant                |
