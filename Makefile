.PHONY: build

build: build-dev build-manual

# Build a single documentation
build-dev:
	cd page; hugo \
		--cleanDestinationDir \
		--environment dev \
		--destination ../build/dev \
		--verbose \
		--baseURL https://docs.contao.org/dev/

build-manual:
	cd page; hugo \
		--cleanDestinationDir \
		--environment manual \
		--destination ../build/manual \
		--verbose \
		--baseURL https://docs.contao.org/manual/

# Start a live reload server
live-dev:
	cd page; hugo server \
		--cleanDestinationDir \
		--environment dev \
		--destination ../build/dev \
		--verbose

live-manual:
	cd page; hugo server \
		--cleanDestinationDir \
		--environment manual \
		--destination ../build/manual \
		--verbose

clean:
	rm -r build
