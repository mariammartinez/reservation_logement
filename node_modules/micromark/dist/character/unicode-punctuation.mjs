import regexCheck from '../util/regex-check.mjs'
import unicodePunctuation$1 from '../constant/unicode-punctuation-regex.mjs'

// In fact adds to the bundle size.

var unicodePunctuation = regexCheck(unicodePunctuation$1)

export default unicodePunctuation
