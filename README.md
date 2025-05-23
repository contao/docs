# Contao Documentation

The [documentation for the Contao project](https://docs.contao.org/) will be maintained in this repository.

The details below are only necessary if you want to install the docs locally.
If you just want to contribute content, read the [CONTRIBUTING](CONTRIBUTING.md) or these detailed [instructions](https://docs.contao.org/manual/en/contributing/).


## Cloning

The project installs the [Hugo Relearn Theme](https://mcshelby.github.io/hugo-theme-relearn/) as a git submodule. Thus when cloning
the repository, you need to use the `--recurse-submodules` parameter:

```bash
git clone --recurse-submodules git@github.com:contao/docs.git
```
or:

```bash
git clone --recurse-submodules https://github.com/contao/docs.git
```


## Updating the Theme

Due to the switch of the theme from Hugo Learn to Hugo Relearn, you will need to execute

```bash
git submodule sync
git submodule update
```

once, if you had already checked out the repository before the switch.

To update the theme after cloning - or after the theme switch, run the following command:

```bash
git submodule foreach git pull origin main
```

## Build

The documentation is built using the [Hugo site generator](https://gohugo.io/), 
thus you need to [install Hugo](https://gohugo.io/getting-started/installing/) 
first on your system.

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
directory and rebuilds the front end. You can access the front end on [http://localhost:1313](http://localhost:1313).

```
make clean
```

Cleans the build directory.


### Note

You are not dependent on the [Makefile](Makefile). If `make` is not available 
in your operating system, you can still invoke the hugo commands. For example:

```
cd page
hugo server --cleanDestinationDir --environment manual --destination ../build/manual 
```

Or for the Developer Documentation:

```
cd page
hugo server --cleanDestinationDir --environment dev --destination ../build/dev 
```


## License

The Contao documentation is licensed under a [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International
License](https://creativecommons.org/licenses/by-nc-sa/4.0/) license (CC BY-NC-SA 4.0). If you want to redistribute a modified or unmodified version of the documentation, you can do so under the license terms.

If you contribute to the documentation, e.g. by creating pull requests, you grant us full usage rights of any content you create or upload. You also ensure that your
content does not violate any third-party rights.

We are not claiming exclusive usage rights, therefore you are free to use your
contributed content (e.g. texts or images) in any other project as well.
