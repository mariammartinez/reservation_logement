import markdownLineEnding from '../character/markdown-line-ending.mjs'
import markdownSpace from '../character/markdown-space.mjs'
import spaceFactory from './factory-space.mjs'

function whitespaceFactory(effects, ok) {
  var seen
  return start

  function start(code) {
    if (markdownLineEnding(code)) {
      effects.enter('lineEnding')
      effects.consume(code)
      effects.exit('lineEnding')
      seen = true
      return start
    }

    if (markdownSpace(code)) {
      return spaceFactory(
        effects,
        start,
        seen ? 'linePrefix' : 'lineSuffix'
      )(code)
    }

    return ok(code)
  }
}

export default whitespaceFactory
