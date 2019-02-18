.PHONY: build
build:
	cd page; hugo \
		--cleanDestinationDir \
		--contentDir ../docs \
		--destination ../build \
		--verbose

dev:
	cd page; hugo server \
		--cleanDestinationDir \
		--contentDir ../docs \
		--destination ../build \
		--verbose

clean:
	rm -r build
