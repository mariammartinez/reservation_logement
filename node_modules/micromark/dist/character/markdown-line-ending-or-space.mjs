function markdownLineEndingOrSpace(code) {
  return code < 0 || code === 32
}

export default markdownLineEndingOrSpace
