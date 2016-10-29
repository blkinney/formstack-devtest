# Ben Kinney's MVC CRUD Project Environment Setup

## Prerequisites

- Virtualbox >= 5.1
- Vagrant >= 1.8.6
- Git
- Root access to your local machine

## Getting your Environment Setup
- Download or clone [this Git repository](https://github.com/blkinney/formstack-devtest).
- Start Vagrant using the Vagrantfile supplied in the repository.

    ```
    vagrant up
    ```

- Access the project at http://192.168.33.10/.
- Update your `/etc/hosts` file

    ```
    echo 192.168.59.76   testbox.dev www.testbox.dev | sudo tee -a /etc/hosts
    ```

- Next you can simply use the `vagrant up` command to start provisioning your local environment!
- Adding an index.php file into your repository should allow you to see its contents at http://www.testbox.dev
- Remember part of the process is to see how you work so commit and push changes as you would on day to day projects.

| Type           | Value                  |
|----------------|------------------------|
| MySQL Username | root                 |
| Mysql Password | root                 |
| Mysql Database | scotchbox                 |
| SSH Username   | vagrant                |
| SSH Password   | vagrant                |
