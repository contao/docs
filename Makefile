.PHONY: build

build: build-dev build-manual

# Build a single documentation
build-dev:
	cd page; hugo \
		--cleanDestinationDir \
		--environment dev \
		--destination ../build/dev \
		--logLevel info \
		--baseURL https://docs.contao.org/dev/

build-manual:
	cd page; hugo \
		--cleanDestinationDir \
		--environment manual \
		--destination ../build/manual \
		--logLevel info \
		--baseURL https://docs.contao.org/manual/

# Start a live reload server
live-dev:
	cd page; hugo server \
		--cleanDestinationDir \
		--environment dev \
		--destination ../build/dev \
		--debug

live-manual:
	cd page; hugo server \
		--cleanDestinationDir \
		--environment manual \
		--destination ../build/manual \
		--debug

clean:
	rm -r build
