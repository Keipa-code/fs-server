import React from 'react';
import {makeAutoObservable} from 'mobx';

export default class FileStore {
  constructor() {
    this._files = []
    this._totalCount = 0
    this._page = 1
    this._limit = 20
    makeAutoObservable(this)
  }

  get limit() {
    return this._limit;
  }

  set limit(value) {
    this._limit = value;
  }
  get page() {
    return this._page;
  }

  set page(value) {
    this._page = value;
  }
  get totalCount() {
    return this._totalCount;
  }

  set totalCount(value) {
    this._totalCount = value;
  }
  get files() {
    return this._files;
  }

  set files(value) {
    this._files = value;
  }
}