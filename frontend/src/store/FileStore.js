import { makeAutoObservable } from 'mobx'

export default class FileStore {
  constructor() {
    this._files = []
    this._totalCount = 0
    this._page = 1
    this._limit = 5
    this._sorting = ''
    this._submitted = false
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
    return this._sorting
  }

  setSorting(value) {
    this.setPage(1)
    this._sorting = value
  }

  get submitted() {
    return this._submitted
  }

  setSubmitted(value) {
    this._submitted = value
  }
}
