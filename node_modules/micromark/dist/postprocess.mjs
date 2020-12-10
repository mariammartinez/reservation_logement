import subtokenize from './util/subtokenize.mjs'

function postprocess(events) {
  while (!subtokenize(events)) {
    // Empty
  }

  return events
}

export default postprocess
