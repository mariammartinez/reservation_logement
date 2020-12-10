import miniflat from './util/miniflat.mjs'
import * as content from './initialize/content.mjs'
import * as document from './initialize/document.mjs'
import * as flow from './initialize/flow.mjs'
import {string, text} from './initialize/text.mjs'
import combineExtensions from './util/combine-extensions.mjs'
import createTokenizer from './util/create-tokenizer.mjs'
import * as constructs from './constructs.mjs'

function parse(options) {
  var settings = options || {}
  var parser = {
    defined: [],
    constructs: combineExtensions(
      [constructs].concat(miniflat(settings.extensions))
    ),
    content: create(content),
    document: create(document),
    flow: create(flow),
    string: create(string),
    text: create(text)
  }
  return parser

  function create(initializer) {
    return creator

    function creator(from) {
      return createTokenizer(parser, initializer, from)
    }
  }
}

export default parse
