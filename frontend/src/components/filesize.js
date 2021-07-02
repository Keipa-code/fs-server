export function sizeString(size) {
  if(size < 1024){
    return size + 'байт'
  }
  if(size < (1024*1024)) {
    return (size / 1024) + 'кб'
  }
  if(size < (1024*1024*1024)) {
    return (size / 1024*1024) + 'мб'
  }
}