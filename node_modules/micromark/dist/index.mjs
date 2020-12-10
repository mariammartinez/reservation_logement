import compileHtml from './compile/html.mjs'
import parse from './parse.mjs'
import postprocess from './postprocess.mjs'
import preprocess from './preprocess.mjs'

function buffer(value, encoding, options) {
  if (typeof encoding !== 'string') {
    options = encoding
    encoding = undefined
  }

  return compileHtml(options)(
    postprocess(
      parse(options).document().write(preprocess()(value, encoding, true))
    )
  )
}

export default buffer
