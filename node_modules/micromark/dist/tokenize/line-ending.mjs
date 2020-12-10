import spaceFactory from './factory-space.mjs'

var lineEnding = {
  name: 'lineEnding',
  tokenize: tokenizeLineEnding
}

function tokenizeLineEnding(effects, ok) {
  return start

  function start(code) {
    effects.enter('lineEnding')
    effects.consume(code)
    effects.exit('lineEnding')
    return spaceFactory(effects, ok, 'linePrefix')
  }
}

export default lineEnding
