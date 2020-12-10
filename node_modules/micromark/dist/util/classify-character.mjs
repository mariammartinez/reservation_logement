import markdownLineEndingOrSpace from '../character/markdown-line-ending-or-space.mjs'
import unicodePunctuation from '../character/unicode-punctuation.mjs'
import unicodeWhitespace from '../character/unicode-whitespace.mjs'

// Classify whether a character is unicode whitespace, unicode punctuation, or
// anything else.
// Used for attention (emphasis, strong), whose sequences can open or close
// based on the class of surrounding characters.
function classifyCharacter(code) {
  if (
    code === null ||
    markdownLineEndingOrSpace(code) ||
    unicodeWhitespace(code)
  ) {
    return 1
  }

  if (unicodePunctuation(code)) {
    return 2
  }
}

export default classifyCharacter
