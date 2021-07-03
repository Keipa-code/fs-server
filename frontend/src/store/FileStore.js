import { makeAutoObservable } from 'mobx'

export default class FileStore {
  constructor() {
    this._files = []
    this._totalCount = 0
    this._page = 1
    this._limit = 20
    this._sorting = ''
    makeAutoObservable(this)
  }

  get limit() {
    return this._limit
  }

  setLimit(value) {
    this._limit = value
  }

  get page() {
    return this._page
  }

  setPage(value) {
    this._page = value
  }

  get totalCount() {
    return this._totalCount
  }

  setTotalCount(value) {
    this._totalCount = value
  }

  get files() {
    return this._files
  }

  setFiles(value) {
    this._files = value
  }

  get sorting() {
    return this._sort
  }

  setSorting(value) {
    this._sort = value
  }
}
