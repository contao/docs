# Contao Documentation

The documentation for the Contao project will be maintained in this repository.


## Cloning

The project installs the Hugo Learn theme as a git submodule. Thus when cloning 
the repository, you need to use the `--recurse-submodules` parameter:

```bash
git clone --recurse-submodules git@github.com:netzarbeiter/contao-docs.git
```


## Updating the Theme

To update the theme after cloning, simply run the following command:

```bash
git submodule foreach git pull origin master
```


## Build

The documentation is built using the [Hugo site generator](https://gohugo.io/), 
thus you need to [install Hugo](https://gohugo.io/getting-started/installing/) 
first on your system.

_Note:_ version 0.55.x of Hugo is incompatible with some of the theme's features. 
Building is still possible, however the rendering of those shortcodes will be wrong.

Building is done using the `make` command. There are different commands available 
depending on what part of the documentation you want to build.

```
make build-dev
make build-manual
```

Builds the entire documentation into the `build` directory.

```
make live-dev
make live-manual
```

Spins up the development server which automatically tracks changes in the `docs` 
directory and rebuilds the frontend. You can access the frontend on [http://localhost:1313](http://localhost:1313).

```
make clean
```

Cleans the build directory.


## License

The Contao documentation is licensed under a [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International
License](https://creativecommons.org/licenses/by-nc-sa/4.0/) license (CC BY-NC-SA 4.0). If you want to redistribute a modified or unmodified version of the documentation, you can do so under the license terms.

If you contribute to the documentation, e.g. by creating pull requests, you grant us full usage rights of any content you create or upload. You also ensure that your
content does not violate any third-party rights.

We are not claiming exclusive usage rights, therefore you are free to use your
contributed content (e.g. texts or images) in any other project as well.
