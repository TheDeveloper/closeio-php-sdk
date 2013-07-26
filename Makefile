CLOSEIO_API_KEY ?= test

test:
	CLOSEIO_API_KEY=$(CLOSEIO_API_KEY) test/*

.PHONY: test
