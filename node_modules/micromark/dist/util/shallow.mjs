import assign from '../constant/assign.mjs'

function shallow(object) {
  return assign({}, object)
}

export default shallow
