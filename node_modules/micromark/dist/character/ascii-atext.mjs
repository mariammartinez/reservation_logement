import regexCheck from '../util/regex-check.mjs'

var asciiAtext = regexCheck(/[#-'*+\--9=?A-Z^-~]/)

export default asciiAtext
