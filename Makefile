.PHONY: build

build: build-dev build-manual

# Build a single documentation
build-dev:
	cd page; hugo \
		--cleanDestinationDir \
		--contentDir ../docs/dev \
		--destination ../build/dev \
		--config config-dev.yaml \
		--verbose

build-manual:
	cd page; hugo \
		--cleanDestinationDir \
		--contentDir ../docs/manual \
		--destination ../build/manual \
		--config config-manual.yaml \
		--verbose

# Start a live reload server
live-dev:
	cd page; hugo server \
		--cleanDestinationDir \
		--contentDir ../docs/dev \
		--destination ../build/dev \
		--config config-dev.yaml \
		--verbose

live-manual:
	cd page; hugo server \
		--cleanDestinationDir \
		--contentDir ../docs/manual \
		--destination ../build/manual \
		--config config-manual.yaml \
		--verbose

clean:
	rm -r build
